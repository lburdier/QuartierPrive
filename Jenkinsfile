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
        sh "composer update"
        sh "php artisan test"
      }
    }
  }
}