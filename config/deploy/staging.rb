set :stage, :staging
set :branch, 'master'
server '176.57.210.39', roles: :all, port: 22 
set :deploy_to, '/home/w/whidohost/demo.fitpark.rf'
namespace :my do
   task :custom_task do
   end
end
