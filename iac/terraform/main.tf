resource "kubernetes_pod" "infolysis-netapp" {
  metadata {
    name = "infolysis-netapp"
    namespace = "evolved5g"
    labels = {
      app = "InfolysisApp"
    }
  }

  spec {
    container {
      image = "dockerhub.hi.inet/evolved-5g/infolysis-netapp:latest"
      name  = "InfolysisContainer"
    }
  }
}

resource "kubernetes_service" "infolysis-netapp_service" {
  metadata {
    name = "InfolysisService"
    namespace = "evolved5g"
  }
  spec {
    selector = {
      app = kubernetes_pod.example.metadata.0.labels.app
    }
    port {
      port = 6666
      target_port = 6666
    }
  }
}
