pipeline {
  agent any

  environment {
    HOME = '.'
  }

  stages {
    stage('Test') {
      agent {
        docker {
          image 'debian-laravel:latest' // <-- Image générique sans PHP 8 dans le nom
          args '-v /etc/passwd:/etc/passwd -v /etc/group:/etc/group'
        }
      }
      steps {
        echo "📦 Installation des dépendances PHP"
        sh 'composer update'

        echo "⚙️ Copie du fichier .env"
        sh 'cp /.env ${WORKSPACE}/.env'

        echo "✅ Lancement des tests Laravel"
        sh 'php artisan test'
      }
    }

    stage('Deploy') {
      agent {
        docker {
          image 'debian-laravel:latest' // <-- Même image générique ici
          args '-v /etc/passwd:/etc/passwd -v /etc/group:/etc/group'
        }
      }
      steps {
        withCredentials([usernamePassword(credentialsId: 'abb21120-67aa-4ecd-b243-04cdbda6770f	', usernameVariable: 'USERNAME', passwordVariable: 'PASSWORD')]) {
          echo "🚀 Déploiement vers serveur distant"
          
          sh 'echo USERNAME     = $USERNAME'
          sh 'echo PASSWORD     = $PASSWORD'
          sh 'echo WORKSPACE    = ${env.WORKSPACE}'

          // Transfert des fichiers
          sh '''
            /usr/bin/sshpass -p $PASSWORD /usr/bin/scp -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no -r ${WORKSPACE}/* $USERNAME@api.etudiant.etu.sio.local:/private
          '''

          // Installation des dépendances & migration
          sh '''
            /usr/bin/sshpass -p $PASSWORD /usr/bin/ssh -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no $USERNAME@api.etudiant.etu.sio.local '
              cd /private &&
              php /usr/local/bin/composer update &&
              php artisan migrate
            '
          '''
        }
      }
    }
  }
}
