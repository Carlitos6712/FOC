# Kubernetes — Despliegue básico de Apache

Actividad individual del módulo DAW. Despliega **2 réplicas de Apache HTTP Server** en Kubernetes usando un único manifiesto YAML. El entorno de pruebas es **Minikube** (clúster local para Windows).

## Estructura del proyecto

```
Kubernetes/
├── deployment.yaml                  # Manifiesto Kubernetes (Deployment)
├── generate_pdf.py                  # Script que genera el PDF de la actividad
└── DAW00_Actividad_CarlosVico.pdf   # Memoria entregada
```

## Conceptos clave

### Pod
Unidad mínima de despliegue en Kubernetes. Contiene uno o más contenedores que comparten red (IP) y almacenamiento. Kubernetes nunca gestiona contenedores directamente, siempre lo hace a través de Pods.

### Deployment
Recurso que describe el **estado deseado** de un conjunto de Pods. Se encarga de:
- Mantener el número de réplicas especificado en todo momento.
- Actualizar la aplicación sin interrupciones (**rolling update**).
- Revertir automáticamente si la nueva versión falla (**rollback**).

### ReplicaSet
Objeto que el Deployment crea internamente para garantizar que siempre haya exactamente `N` Pods corriendo. No se gestiona directamente; se accede a través del Deployment.

## Manifiesto: `deployment.yaml`

```yaml
apiVersion: apps/v1
kind: Deployment
metadata:
  name: apache-deployment
  labels:
    app: apache
spec:
  replicas: 2
  selector:
    matchLabels:
      app: apache
  template:
    metadata:
      labels:
        app: apache
    spec:
      containers:
        - name: apache
          image: httpd:2.4
          ports:
            - containerPort: 80
          resources:
            requests:
              memory: "64Mi"
              cpu: "100m"
            limits:
              memory: "128Mi"
              cpu: "200m"
```

### Explicación de los campos principales

| Campo | Valor | Descripción |
|---|---|---|
| `apiVersion` | `apps/v1` | Grupo de API estable que incluye Deployment, ReplicaSet, etc. |
| `kind` | `Deployment` | Tipo de recurso a crear |
| `metadata.name` | `apache-deployment` | Nombre único en el clúster |
| `spec.replicas` | `2` | Pods simultáneos que Kubernetes debe mantener |
| `selector.matchLabels` | `app: apache` | Etiqueta que vincula el Deployment con sus Pods |
| `containers[].image` | `httpd:2.4` | Imagen oficial de Apache 2.4 (Docker Hub) |
| `containers[].containerPort` | `80` | Puerto HTTP expuesto dentro del contenedor |

### Límites de recursos

| | CPU | Memoria |
|---|---|---|
| **Request** (mínimo garantizado) | 100m (0.1 vCPU) | 64 MiB |
| **Limit** (máximo permitido) | 200m (0.2 vCPU) | 128 MiB |

> Si el contenedor supera el límite de **memoria** → es terminado (`OOMKilled`).  
> Si supera el límite de **CPU** → se aplica throttling (no se mata el proceso).

## Requisitos

- [Minikube](https://minikube.sigs.k8s.io/) instalado y en `PATH`
- [kubectl](https://kubernetes.io/docs/tasks/tools/) instalado y configurado
- Docker Desktop (o cualquier driver compatible con Minikube)

## Pasos para reproducir el despliegue

### 1. Iniciar el clúster local

```bash
minikube start
```

### 2. Aplicar el manifiesto

```bash
kubectl apply -f deployment.yaml
# deployment.apps/apache-deployment created
```

### 3. Verificar los Pods

```bash
kubectl get pods
```

```
NAME                                  READY   STATUS    RESTARTS   AGE
apache-deployment-7d6b9c8f4-k2pqr     1/1     Running   0          30s
apache-deployment-7d6b9c8f4-xn7wt     1/1     Running   0          30s
```

### 4. Verificar el Deployment

```bash
kubectl get deployments
```

```
NAME                 READY   UP-TO-DATE   AVAILABLE   AGE
apache-deployment    2/2     2            2           45s
```

`READY 2/2` confirma que las dos réplicas están disponibles.

### 5. Diagnóstico adicional

```bash
# Detalles completos de un Pod (eventos, imagen, nodo asignado)
kubectl describe pod <nombre-del-pod>

# Logs de Apache en tiempo real
kubectl logs -f <nombre-del-pod>
```

### 6. Limpiar

```bash
kubectl delete -f deployment.yaml
```

## Generar el PDF de la actividad

```bash
pip install fpdf2
python generate_pdf.py
# → DAW00_Actividad_CarlosVico.pdf
```
