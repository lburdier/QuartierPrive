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
        script {
          echo '🔍 Vérification de l’environnement de base'

          sh '''
            php -v || exit 1
            node -v || true
            npm -v || true
          '''
        }
      }
    }

    stage('Install dependencies') {
      steps {
        script {
          echo '📦 Installation de Composer + dépendances PHP & JS'

          sh '''
            if ! command -v composer > /dev/null; then
              echo "⚙️ Composer non trouvé. Installation en cours..."
              EXPECTED_CHECKSUM="$(php -r 'copy(\"https://composer.github.io/installer.sig\", \"php://stdout\");')"
              php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
              php -r "if (hash_file('sha384', 'composer-setup.php') === '$EXPECTED_CHECKSUM') { echo '✔️ Installateur vérifié'; } else { echo '✖️ Installateur corrompu'; unlink('composer-setup.php'); exit(1); }"
              php composer-setup.php --install-dir=/usr/local/bin --filename=composer
              rm composer-setup.php
            fi

            composer install --prefer-dist --no-interaction

            if [ -f package.json ]; then
              echo "📦 Dépendances JS détectées"
              npm ci || echo "⚠️ npm ci a échoué"
              npm run build || echo "⚠️ Build JS échoué (non bloquant)"
            else
              echo "📁 Aucun package.json, build JS ignoré"
            fi
          '''
        }
      }
    }

    stage('Run Laravel Tests') {
      steps {
        script {
          echo '🧪 Lancement des tests Laravel'

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
          image 'debian-laravel:latest'
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
            echo '🚀 Déploiement vers le serveur distant'

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
