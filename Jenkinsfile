pipeline {
  agent any

  environment {
    HOME = '.'               // Évite des problèmes liés aux chemins
    COMPOSER_MEMORY_LIMIT = '-1' // Pour éviter les erreurs d’out of memory
  }

  stages {
    stage('Preparation') {
      agent {
        docker {
          image 'debian-laravel:latest'
          args '-v /etc/passwd:/etc/passwd -v /etc/group:/etc/group'
        }
      }
      steps {
        echo "🔧 Vérification des dépendances Laravel + environnement Docker"
        sh '''
          php -v
          composer --version
          node -v || true
          npm -v || true
        '''
      }
    }

    stage('Install dependencies') {
      steps {
        sh '''
          composer install --prefer-dist --no-interaction
          if [ -f package.json ]; then
            npm ci
            npm run build || echo "Pas de build JS nécessaire"
          fi
        '''
      }
    }

    stage('Run Laravel Tests') {
      steps {
        sh '''
          cp .env.example .env || true
          php artisan config:clear
          php artisan key:generate || true
          php artisan test
        '''
      }
    }
  }

  post {
    success {
      echo "✅ Pipeline exécutée avec succès !"
    }
    failure {
      echo "❌ Une erreur est survenue durant l'exécution du pipeline."
    }
  }
}
