@servers(['web' => 'robin@robin.lobotomised.net'])

@setup
    $repository = 'git@github.com:lobotomised/robin.git';
    $base_dir = '/home/robin';
    $app_dir = $base_dir . '/current';
    $releases_dir = $base_dir . '/releases';
    $release_name = date('Ymd-His');
    $new_release_dir = $releases_dir .'/'. $release_name;

    function logMessage($message) {
        return "echo '\033[32m" .$message. "\033[0m';\n";
    }
@endsetup

@story('deploy')
    clone_repository
    publish_commit_sha
    run_composer
    run_npm
    update_symlinks
    migrate_db
    laravel_cache
    remove_old_release
@endstory

@task('clone_repository')
    {{ logMessage("🌀 Cloning repository") }}
    [ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }}
    git clone --depth 1 {{ $repository }} {{ $new_release_dir }}
@endtask

@task('publish_commit_sha')
    @if ($commit)
        {{ logMessage('write current commit sha') }}
        echo {{ $commit }} > {{ $new_release_dir }}/commit_sha
    @endif
@endtask

@task('run_composer')
    {{ logMessage("🚚 Running Composer") }}
    cd {{ $new_release_dir }}
    composer install --prefer-dist --no-dev --no-ansi --no-interaction --no-progress --no-scripts --optimize-autoloader
@endtask

@task('run_npm')
    {{ logMessage("📦 Running npm...") }}
    cd {{ $new_release_dir }}
    npm ci
    npm run production
    rm -Rf {{ $new_release_dir }}/node_modules
@endtask

@task('update_symlinks')
    {{ logMessage("🔄 Linking storage directory") }}

    # Remove the storage directory and replace with de persistent one
    rm -rf {{ $new_release_dir }}/storage
    ln -nfs {{ $base_dir }}/persistent/storage {{ $new_release_dir }}/storage

    # Link the .env
    ln -nfs {{ $base_dir }}/.env {{ $new_release_dir }}/.env

    {{ logMessage("Linking current release") }}
    ln -nfs {{ $new_release_dir }} {{ $app_dir }}
@endtask

@task('migrate_db')
    {{ logMessage("🙈 Migrating database") }}
    cd {{ $new_release_dir }}
    php artisan db:backup
    php artisan migrate --force
@endtask

@task('laravel_cache')
    {{ logMessage("🗳 Building cache") }}
    cd {{ $new_release_dir }}
    php artisan route:cache
    php artisan config:cache
    php artisan view:cache
@endtask

@task('remove_old_release')
    {{ logMessage("⛏ Removing old release") }}
    ls -dt {{ $releases_dir }}/* | tail -n +6 | xargs -d "\n" rm -rf
@endtask
