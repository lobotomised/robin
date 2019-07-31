@servers(['web' => 'robin@robin.rprevost.fr'])

@setup
    $repository = 'git@gitlab.com:lobotomised/robin.git';
    $releases_dir = '/var/www/robin/releases';
    $app_dir = '/var/www/robin/current';
    $release = date('YmdHis');
    $new_release_dir = $releases_dir .'/'. $release;
@endsetup

@story('deploy')
    clone_repository
    run_composer
    run_yarn
    migrate_db
    update_symlinks
@endstory

@task('clone_repository')
    echo 'Cloning repository'
    [ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }}
    git clone --depth 1 {{ $repository }} {{ $new_release_dir }}
@endtask

@task('run_composer')
    echo "🚚  Running Composer"
    cd {{ $new_release_dir }}
    composer install --prefer-dist --no-dev --no-ansi --no-interaction --no-progress --no-scripts --optimize-autoloader
@endtask

@task('run_yarn')
    echo "📦  Running Yarn..."
    cd {{ $new_release_dir }}
    yarn install --frozen-lockfile
    yarn run production
@endtask

@task('migrate_db')
    echo "🙈  Migrating database..."
    cd {{ $new_release_dir }}
    php artisan migrate --force
@endtask

@task('update_symlinks')
    echo "Linking storage directory"
    rm -rf {{ $new_release_dir }}/storage
    ln -nfs {{ $app_dir }}/storage {{ $new_release_dir }}/storage

    echo 'Linking .env file'
    ln -nfs {{ $app_dir }}/.env {{ $new_release_dir }}/.env

    echo 'Linking current release'
    ln -nfs {{ $new_release_dir }} {{ $app_dir }}/current
@endtask
