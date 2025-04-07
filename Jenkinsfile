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
        withCredentials([usernamePassword(credentialsId: 'abb21120-67aa-4ecd-b243-04cdbda6770f', usernameVariable: 'USERNAME', passwordVariable: 'PASSWORD')]) {
          echo '🔐 Connexion SSH en cours...'

          sh 'echo USERNAME     = $USERNAME'
          sh 'echo WORKSPACE    = ${env.WORKSPACE}'

          // Transfert des fichiers
          sh '''
            /usr/bin/sshpass -p $PASSWORD /usr/bin/scp \
              -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no \
              -r ${WORKSPACE}/* $USERNAME@api.UTI302.etu.sio.local:/private
          '''

          // Commandes distantes sur le serveur
          sh '''
            /usr/bin/sshpass -p $PASSWORD /usr/bin/ssh \
              -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no \
              $USERNAME@api.UTI302.etu.sio.local '
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
