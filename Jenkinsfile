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
        sh '''
          composer update
          cp /.env ${WORKSPACE}/.env || true
          php artisan test
        '''
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
            credentialsId: '55b96359-6f51-4959-a822-e0815b4338a2',
            usernameVariable: 'USERNAME',
            passwordVariable: 'PASSWORD'
          )
        ]) {
          sh '''
            echo "USERNAME     = $USERNAME"
            echo "WORKSPACE    = $WORKSPACE"

            /usr/bin/sshpass -p "$PASSWORD" /usr/bin/scp \
              -o UserKnownHostsFile=/dev/null \
              -o StrictHostKeyChecking=no \
              -r "$WORKSPACE"/* "$USERNAME"@immo.burdier.net.local:/private

            /usr/bin/sshpass -p "$PASSWORD" /usr/bin/ssh \
              -o UserKnownHostsFile=/dev/null \
              -o StrictHostKeyChecking=no \
              "$USERNAME"@immo.burdier.net.local '
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
