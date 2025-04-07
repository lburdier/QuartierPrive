pipeline {
  agent any
  environment {
  }
  stages {
      agent {
        docker {
          image 'debian-laravel:latest'
          args '-v /etc/passwd:/etc/passwd -v /etc/group:/etc/group'
        }
      }
      steps {
      }
    }
  }
}
