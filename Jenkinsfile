pipeline {
  agent any

  environment {
    HOME = '.'
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
              apt-get update && apt-get install -y sshpass
            
              echo "📁 WORKSPACE = ${WORKSPACE}"
              /usr/bin/sshpass -p $PASSWORD scp -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no -r ${WORKSPACE}/* $USERNAME@api.etudiant.etu.sio.local:/private
              /usr/bin/sshpass -p $PASSWORD ssh -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no $USERNAME@api.etudiant.etu.sio.local '
                cd /private ;
                php /usr/local/bin/composer update ;
                php artisan migrate
              '
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

    stage('Deploy') {
      agent {
        docker {
          image 'lorisleiva/laravel-docker:stable'
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
              /usr/bin/sshpass -p $PASSWORD /usr/bin/scp -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no -r ${WORKSPACE}/* $USERNAME@api.etudiant.etu.sio.local:/private
              /usr/bin/sshpass -p $PASSWORD /usr/bin/ssh -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no $USERNAME@api.etudiant.etu.sio.local '
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
