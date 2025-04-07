pipeline {
  agent any

  environment {
    HOME = '.'
    COMPOSER_MEMORY_LIMIT = '-1'
  }

  options {
    timestamps()
    ansiColor('xterm') // Pour une sortie plus lisible
  }

  stages {
    stage('Environment Check') {
      agent {
        docker {
          image 'debian-laravel:latest'
          args '-u root -v /etc/passwd:/etc/passwd -v /etc/group:/etc/group'
        }
      }
      steps {
        echo '🔧 Vérification des outils disponibles'
        sh '''
          echo "PHP : $(php -v | head -n 1)"
          echo "Composer : $(composer --version)"
          echo "Node.js : $(node -v || echo 'non installé')"
          echo "NPM : $(npm -v || echo 'non installé')"
        '''
      }
    }

    stage('Install Dependencies') {
      steps {
        echo '📦 Installation des dépendances PHP & JS'
        sh '''
          composer install --prefer-dist --no-interaction

          if [ -f package.json ]; then
            npm ci
            npm run build || echo "⚠️ Build JS non requis ou échoué"
          fi
        '''
      }
    }

    stage('Prepare Laravel') {
      steps {
        echo '🧪 Préparation de l’environnement Laravel'
        sh '''
          cp .env.example .env || true
          php artisan config:clear
          php artisan key:generate || true
        '''
      }
    }

    stage('Run Tests') {
      steps {
        echo '✅ Exécution des tests Laravel'
        sh 'php artisan test --parallel || php artisan test'
      }
    }
  }

  post {
    success {
      echo '🎉 Pipeline terminée avec succès.'
    }
    failure {
      echo '💥 Échec de la pipeline. Consulte les logs ci-dessus.'
    }
    always {
      echo '📄 Fin de l’exécution du pipeline.'
    }
  }
}
