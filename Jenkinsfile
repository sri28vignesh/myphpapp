pipeline {
    agent any
 
 stages {
     
    stage ('Build Mysql Image'){
        steps{
            sh 'docker build -t mysql-image ./mysql_service'
            sh 'docker tag mysql-image mysql-image:$BUILD_NUMBER'
            sh 'docker tag mysql-image mysql-image:latest'
        }
    }

    stage ('Scan Mysql Image'){
        steps{
            sh '''result=trivy image mysql-image | grep -i total
            echo $result
            error("Build failed because of vulnerability in mysql image..")     
            '''
        }
    }
    
    stage('Backup Mysql'){
            steps{
                sh 'docker top mysql-service || docker run -d --name mysql-service -p 3306:3306 mysql-image:latest'
                sh 'docker commit mysql-service mysql-service-backup-$BUILD_NUMBER'
            }
        }
    stage('Run MySql Service'){
        steps{
            sh 'docker stop mysql-service && docker rm mysql-service'
            sh 'docker run -d --name mysql-service -p 3306:3306 mysql-image:latest'
        }
    } 
    stage('Build Php Image') {
           steps {
              
                sh 'docker build -t php-demoapp .' 
                sh 'docker tag php-demoapp php-demoapp:latest'
                sh 'docker tag php-demoapp php-demoapp:$BUILD_NUMBER'
               
          }
        }

    stage('Backup Php'){
        steps{
            sh 'docker top sri-php-container || docker run -d --name sri-php-container -p 5001:80 --link mysql-service php-demoapp:latest'
            sh 'docker commit sri-php-container sri-php-container-$BUILD_NUMBER'
        }
    } 
    stage('Deploy 2Tier App'){
        steps{
             sh 'docker stop sri-php-container && docker rm sri-php-container'
             sh 'docker run -d --name sri-php-container -p 5001:80 --link mysql-service php-demoapp:latest'
        }
    }
     
    }
 }