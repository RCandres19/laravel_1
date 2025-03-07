<script setup>
import { useRouter } from 'vue-router'; // Importamos useRouter para manejar la navegación

const router = useRouter(); // Inicializamos el enrutador

// Función para redirigir a la página de inicio de sesión
const goToLogin = () => {
  router.push('/login'); // Redirige al usuario a la ruta "/login"
};
</script>

<template>
  <div class="container">
    <!-- Botón que al hacer clic ejecuta la función goToLogin -->
    <button @click="goToLogin" class="login-btn">Iniciar sesión</button>
  </div>
</template>

<style scoped>
/* Contenedor principal que cubre toda la pantalla */
.container {
  background-image: url('@/assets/img/cultivasena.png'); /* Ruta de la imagen */
  background-size: cover; /* Ajusta la imagen para cubrir todo sin distorsión */
  background-position: center; /* Centra la imagen */
  background-repeat: no-repeat; /* Evita que la imagen se repita */
  width: 100vw; /* Ocupar todo el ancho */
  height: 100vh; /* Ocupar toda la altura */
  position: fixed; /* Fijar imagen para que no se mueva */
  top: 0;
  left: 0;
  display: flex;
  justify-content: flex-end; /* Botón alineado a la derecha */
  align-items: flex-start; /* Botón alineado arriba */
  padding: 20px; /* Espaciado para que el botón no esté pegado */
}

/* Botón de inicio de sesión */
.login-btn {
  padding: 12px 24px;
  background-color: rgb(28, 138, 52);
  color: rgb(255, 255, 255);
  border: none;
  cursor: pointer;
  font-size: 16px;
  font-weight: bold;
  border-radius: 10px;
  transition: background-color 0.3s ease;
}

/* Cambio de color al pasar el mouse */
.login-btn:hover {
  background-color: #131183;
}

/* RESPONSIVE - Ajustes para pantallas pequeñas */
@media (max-width: 768px) {
  .container {
    background-size: cover; /* Mantiene la imagen bien ajustada */
  }

  .login-btn {
    font-size: 14px;
    padding: 10px 20px;
    margin-right: 30px; /* Espaciado para que no esté pegado */
    margin-top: 10px;
  }
}
</style>


<!--<style scoped>
.container {
  background-image: url('@/assets/img/cultivasena.png'); /* Ruta de la imagen */
  background-size: cover; /* Ajusta la imagen sin distorsionarla */
  background-position: center; /* Centra la imagen */
  background-repeat: no-repeat; /* Evita repeticiones */
 
  height: 100vh; /* Ocupa toda la pantalla */
  min-height: 100vh; /* Asegura compatibilidad */
  display: flex;
  justify-content: flex-end; /* Botón alineado a la derecha */
  align-items: start; /* Botón en la parte superior */
  padding: 20px;
}

.login-btn {
  padding: 12px 24px;
  background-color: rgb(28, 138, 52); /* Verde original */
  color: white;
  border: none;
  cursor: pointer;
  font-size: 16px;
  font-weight: bold;
  border-radius: 10px;
  transition: background-color 0.3s ease;
}

.login-btn:hover {
  background-color: rgb(20, 100, 40); /* Verde más oscuro para el hover */
}
</style>  -->



