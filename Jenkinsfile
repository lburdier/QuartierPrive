pipeline {
  agent any

  environment {
    HOME = '.'
  }

  stages {

    stage('Test') {
      agent {
        docker {
          // ✅ Image contenant déjà PHP, Composer, Node.js
          image 'lorisleiva/laravel-docker:stable'
          args '-v /etc/passwd:/etc/passwd -v /etc/group:/etc/group'
        }
      }
      steps {
        script {
          echo '🔍 Vérification de l’environnement de base'
          sh '''
            php -v || exit 1
            composer --version || exit 1
            node -v || true
            npm -v || true
          '''
        }
      }
    }

    stage('Install dependencies') {
      agent {
        docker {
          image 'lorisleiva/laravel-docker:stable'
          args '-v /etc/passwd:/etc/passwd -v /etc/group:/etc/group'
        }
      }
      steps {
        script {
          echo '📦 Installation des dépendances Laravel et JS'
          sh '''
            composer install --prefer-dist --no-interaction

            if [ -f package.json ]; then
              echo "📦 Dépendances JS détectées"
              npm ci || echo "⚠️ npm ci a échoué"
              npm run build || echo "⚠️ Échec build JS (non bloquant)"
            else
              echo "📁 Aucun package.json trouvé, JS ignoré"
            fi
          '''
        }
      }
    }

    stage('Run Laravel Tests') {
      agent {
        docker {
          image 'lorisleiva/laravel-docker:stable'
          args '-v /etc/passwd:/etc/passwd -v /etc/group:/etc/group'
        }
      }
      steps {
        script {
          echo '🧪 Exécution des tests Laravel'
          sh '''
            cp /.env ${WORKSPACE}/.env || true
            php artisan config:clear
            php artisan key:generate || true
            php artisan migrate:fresh --seed || true
            php artisan test
          '''
        }
      }
    }

    stage('Deploy') {
      agent {
        docker {
          image 'lorisleiva/laravel-docker:stable'
          args '-v /etc/passwd:/etc/passwd -v /etc/group:/etc/group'
        }
      }
      steps {
        withCredentials([usernamePassword(
          credentialsId: 'abb21120-67aa-4ecd-b243-04cdbda6770f',
          usernameVariable: 'USERNAME',
          passwordVariable: 'PASSWORD'
        )]) {
          script {
            echo '🚀 Déploiement sur serveur distant'
            sh '''
              echo 🔐 USERNAME = $USERNAME
              echo 📁 WORKSPACE = ${env.WORKSPACE}

              /usr/bin/sshpass -p $PASSWORD /usr/bin/scp \
                -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no \
                -r ${WORKSPACE}/* $USERNAME@api.etudiant.etu.sio.local:/private

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
