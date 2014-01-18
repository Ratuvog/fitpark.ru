set :application, 'demo.fitpark.rf'
set :repo_url, 'git@github.com:Ratuvog/fitpark.ru.git'
set :tmp_dir,  "/home/w/whidohost/.tmp"
# ask :branch, proc { `git rev-parse --abbrev-ref HEAD`.chomp }

# set :deploy_to, '/var/www/my_app'
set :scm, :git
set :ssh_options, { 
 forward_agent:true,
  user: 'whidohost' 
}

set :format, :pretty
set :log_level, :debug
set :deploy_via, :remote_cache

set :path_to_share, '/home/w/whidohost/shared'
path_to_image_club = "#{fetch(:path_to_share)}/club"
local_path_to_src = '/home/dmitry/fitpark.ru/fitpark.ru'
# set :pty, true

# set :linked_files, %w{config/database.yml}
# set :linked_dirs, %w{bin log tmp/pids tmp/cache tmp/sockets vendor/bundle public/system}

# set :default_env, { path: "/opt/ruby/bin:$PATH" }
set :keep_releases, 5
namespace :my do
	task :run_custom_tasks do
		invoke 'my:create_image_club_symlink'
		invoke 'my:copy_config'
		invoke 'my:setup_composer'
		invoke 'my:run_migration'
        invoke 'my:custom_task'
	end

	task :create_image_club_symlink do
		on roles :all do
			execute :ln, '-s', path_to_image_club, "#{deploy_to}/public_html/image"
		end
	end	

	task :copy_config do
		on roles :all do
			upload! "#{local_path_to_src}/config/deploy/#{fetch(:stage)}/config/database.php", "#{deploy_to}/public_html/application/config"
			upload! "#{local_path_to_src}/config/deploy/#{fetch(:stage)}/config/config.php", "#{deploy_to}/public_html/application/config"
			upload! "#{local_path_to_src}/config/deploy/shared/depending_on_host.php", "#{deploy_to}/public_html/application/config"
		end
	end	

	task :setup_composer do
		on roles :all do
			execute :curl, '-sS', "-o #{deploy_to}/current/composer.phar", 'https://getcomposer.org/installer ', '&&', 
			"php #{deploy_to}/current/composer.phar -- --install-dir=#{deploy_to}/current", "&&", 
			:cd, "#{deploy_to}/current", "&&",
			:php, "composer.phar", 'install --no-dev'
		end
	end

	task :run_migration do
		on roles :all do
			execute :php, "#{deploy_to}/current/cli-index.php", "MigrationRunner", "up"
		end
	end
end

namespace :deploy do   
  task :restart do
  end

  after 'deploy:cleanup', 'my:run_custom_tasks'
end
