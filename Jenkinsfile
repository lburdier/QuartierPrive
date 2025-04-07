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
        echo '🔍 Vérification environnement Laravel'
        sh '''
          php -v || exit 1
          composer --version || exit 1
        '''

        echo '📦 Installation des dépendances'
        sh 'composer install --prefer-dist --no-interaction'

        echo '⚙️ Copie du fichier .env'
        sh 'cp /.env ${WORKSPACE}/.env || true'

        echo '🧪 Lancement des tests Laravel'
        sh 'php artisan config:clear'
        sh 'php artisan key:generate || true'
        sh 'php artisan migrate:fresh --seed || true'
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
            credentialsId: 'abb21120-67aa-4ecd-b243-04cdbda6770f',
            usernameVariable: 'USERNAME',
            passwordVariable: 'PASSWORD'
          )
        ]) {
          echo '🚀 Déploiement vers le serveur distant'

          sh 'echo 🔐 USERNAME     = $USERNAME'
          sh 'echo 📁 WORKSPACE    = ${env.WORKSPACE}'

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
                composer install --no-interaction && \
                php artisan migrate --force
              '
          '''
        }
      }
    }
  }

  post {
    success {
      echo '✅ Pipeline terminée avec succès.'
    }
    failure {
      echo '❌ Une erreur est survenue durant la pipeline.'
    }
  }
}
