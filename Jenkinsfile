pipeline {
  agent any

  environment {
    HOME = '.'
    COMPOSER_MEMORY_LIMIT = '-1' // éviter les erreurs de mémoire Composer
  }

  stages {

    stage('Test') {
      agent {
        docker {
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
            composer install --prefer-dist --no-interaction || true
            composer require laravel/ui --dev || true

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
            cp .env.example .env || true
            php artisan config:clear
            php artisan key:generate || true
            php artisan migrate:fresh --seed --force || true
            php artisan test
          '''
        }
      }
    }

    stage('Build custom Docker image') {
      steps {
        script {
          echo '🐳 Construction de l\'image Docker personnalisée avec sshpass'
          sh '''
            docker build -t lucas/laravel-sshpass:latest .
          '''
        }
      }
    }

    stage('Deploy') {
      agent {
        docker {
          image 'lucas/laravel-sshpass:latest'
          args '-v /etc/passwd:/etc/passwd -v /etc/group:/etc/group'
        }
      }
      steps {
        script {
          withCredentials([usernamePassword(
            credentialsId: '55b96359-6f51-4959-a822-e0815b4338a2',
            usernameVariable: 'USERNAME',
            passwordVariable: 'PASSWORD'
          )]) {
            echo "🔐 Déploiement avec l'utilisateur : ${USERNAME}"
            sh '''
              echo "📁 WORKSPACE = ${WORKSPACE}"
              sshpass -p $PASSWORD scp -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no -r ${WORKSPACE}/* $USERNAME@api.etudiant.etu.sio.local:/private
              sshpass -p $PASSWORD ssh -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no $USERNAME@api.etudiant.etu.sio.local '
                cd /private ;
                php /usr/local/bin/composer update ;
                php artisan migrate
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
