set :stage, :production
server '176.57.210.39', roles: :all, port: 22 
set :branch, 'production'
set :deploy_to, '/home/w/whidohost/fitpark.rf'
namespace :my do
   task :custom_task do
       on roles :all do
           execute :rm, '-rf', "#{fetch(:deploy_to)}/public_html/yandex_*"
           execute :rm, '-rf', "#{fetch(:deploy_to)}/public_html/.htaccess"
           execute :ln, '-s', "#{fetch(:path_to_share)}/yandex_*", "#{fetch(:deploy_to)}/public_html"
           execute :ln, '-s', "#{fetch(:path_to_share)}/.htaccess","#{fetch(:deploy_to)}/public_html"
       end
   end
end
