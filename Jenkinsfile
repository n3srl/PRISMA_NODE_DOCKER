pipeline {
    agent any
    
    stages {
        stage('Build') {
            steps {
                sh 'docker build -t freeture13 ./freeture13'
            }
        }
    }
    
    post {
        failure {
            mail to: 'andrea.novati@n-3.it',
                 subject: 'Docker build failed',
                 body: 'The Docker build failed for the freeture13 image.'
        }
    }
}