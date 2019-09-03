@servers(['web' => 'robin@robin.lobotomised.net'])

@setup
    $repository = 'git@gitlab.com:lobotomised/robin.git';
    $releases_dir = '/var/www/robin/releases';
    $app_dir = '/var/www/robin/current';
    $release = date('Y-m-d H:i:s');
    $new_release_dir = $releases_dir .'/'. $release;

    function logMessage($message) {
        $tag = '['.date('Y-m-d H:i:s').'] ';
        return "echo '\033[32m" .$tag.$message. "\033[0m';\n";
    }
@endsetup

@story('deploy')
    clone_repository
    run_composer
    run_yarn
    cleanup_build_process
    down
    update_symlinks
    migrate_db
    laravel_cache
    up
    publish_commit_sha
    remove_old_release
@endstory

@task('clone_repository')
    {{ logMessage("🌀 Cloning repository") }}
    [ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }}
    git clone --depth 1 {{ $repository }} {{ $new_release_dir }}
@endtask

@task('run_composer')
    {{ logMessage("🚚 Running Composer") }}
    cd {{ $new_release_dir }}
    composer install --prefer-dist --no-dev --no-ansi --no-interaction --no-progress --no-scripts --optimize-autoloader
@endtask

@task('run_yarn')
    {{ logMessage("📦 Running Yarn...") }}
    cd {{ $new_release_dir }}
    yarn config set ignore-engines true
    yarn install --frozen-lockfile
    yarn run production
@endtask

@task('cleanup_build_process')
    {{ logMessage("🗳 Cleanup build dependencies") }}
    cd {{ $new_release_dir }}
    rm -Rf {{ $new_release_dir }}/node_modules
@endtask

@task('down')
    {{ logMessage("Laravel go into maintenance mode") }}
    cd {{ $new_release_dir }}
    php artisan down
@endtash

@task('update_symlinks')
    {{ logMessage("🔄 Linking storage directory") }}

    # Remove the storage directory and replace with de persistent one
    rm -rf {{ $new_release_dir }}/storage
    ln -nfs {{ $app_dir }}/storage {{ $new_release_dir }}/storage

    # Link the .env
    echo 'Linking .env file'
    ln -nfs {{ $app_dir }}/.env {{ $new_release_dir }}/.env

    echo 'Linking current release'
    ln -nfs {{ $new_release_dir }} {{ $app_dir }}/current
@endtask

@task('migrate_db')
    {{ logMessage("🙈 Migrating database") }}
    cd {{ $new_release_dir }}
    php artisan doctrine:migration:migrate --force
@endtask

@task('laravel_cache')
    {{ logMessage("🗳 Building cache") }}
    cd {{ $new_release_dir }}
    php artisan route:cache
    php artisan config:cache
    php artisan view:cache
@endtask

@task('up')
    {{ logMessage("Laravel go out of maintenance mode") }}
    cd {{ $new_release_dir }}
    php artisan up
@endtash

@task('publish_commit_sha')
    {{ logMessage('write current commit sha') }}
    cd {{ $new_release_dir }}
    @if ($commit)
        echo release: {{ $commit }} > public/release.txt
    @endif
@endtask

@task('remove_old_release')
    {{ logMessage("⛏ Removing old release") }}
    ls -dt releases/* | tail -n +6 | xargs -d "\n" rm -rf
@endtask
