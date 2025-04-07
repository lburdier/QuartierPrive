
pipeline {
  agent any
  environment {
    HOME = '.'
  }
  stages {
    stage('Test') {
      agent {
        docker {
          image 'debian-laravel:latest'
          args '-v /etc/passwd:/etc/passwd -v /etc/group:/etc/group'
        }
      }
      steps {
        sh "composer update"
        sh "cp /.env ${workspace}/.env"
        sh "php artisan test"
      }
    }
    stage('Deploy') {
      agent {
        docker {
          image 'debian-laravel:latest'
          args '-v /etc/passwd:/etc/passwd -v /etc/group:/etc/group'
        }
      }
      steps {
        withCredentials([usernamePassword(credentialsId: 'abb21120-67aa-4ecd-b243-04cdbda6770f', usernameVariable: 'USERNAME', passwordVariable: 'PASSWORD')])
         {
          sh "echo USERNAME     = $USERNAME"
          sh "echo PASSWORD     = $PASSWORD"
          sh "echo WORKSPACE    = ${env.WORKSPACE}"
          sh "/usr/bin/sshpass -p $PASSWORD /usr/bin/scp -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no -r ${env.WORKSPACE}/* $USERNAME@api.etudiant.etu.sio.local:/private"
          sh "/usr/bin/sshpass -p $PASSWORD /usr/bin/ssh -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no $USERNAME@api.etudiant.etu.sio.local 'cd /private ; /usr/bin/ /usr/local/bin/composer update'"
          sh "/usr/bin/sshpass -p $PASSWORD /usr/bin/ssh -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no $USERNAME@api.etudiant.etu.sio.local 'cd /private ; /usr/bin/ artisan migrate'"
        }
      }
    }
