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
        sh 'composer update'
        sh 'cp /.env ${WORKSPACE}/.env'
        sh 'php artisan test'
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
        withCredentials([
          usernamePassword(
            credentialsId: 'ae991101-3c42-4f86-9501-0a3449954f98',
            usernameVariable: 'USERNAME',
            passwordVariable: 'PASSWORD'
          )
        ]) {
          sh 'echo USERNAME     = $USERNAME'
          sh 'echo PASSWORD     = $PASSWORD'
          sh 'echo WORKSPACE    = ${env.WORKSPACE}'

          // Transfert des fichiers
          sh '''
            /usr/bin/sshpass -p $PASSWORD /usr/bin/scp \
              -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no \
              -r ${WORKSPACE}/* $USERNAME@api.etudiant.etu.sio.local:/private
          '''

          // Commandes distantes
          sh '''
            /usr/bin/sshpass -p $PASSWORD /usr/bin/ssh \
              -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no \
              $USERNAME@api.etudiant.etu.sio.local '
                cd /private && \
                composer update && \
                php artisan migrate
              '
          '''
        }
      }
    }
  }
}
