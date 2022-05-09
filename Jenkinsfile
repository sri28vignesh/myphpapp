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
    
    
    stage('Run MySql Service'){
        steps{
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
     
    stage('Deploy 2Tier App'){
        steps{
             sh 'docker run -d --name sri-php-container -p 5001:80 --link mysql-service php-demoapp:latest'
        }
    }
     
    }
 }