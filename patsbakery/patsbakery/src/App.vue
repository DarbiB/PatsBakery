<template>
  <div id="app">
    <header>
      <img alt="Pat's Bakery Logo" src="../src/assets/PatsBakeryLogo.png" width="700" height="105">
    </header>
    <nav>
      <router-link to="/">Home</router-link>
      <router-link to="/addorder">Add Order</router-link>
    </nav>
    <router-view/>
  </div>
</template>

<!-- <script>
import store from '@/store/index.js';

export default {
  computed: {
    auth: function() {
      return store.state.auth;
    }
  }
}
</script> -->

<style>
html {
  background-color: #EFE7DD;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #EFE7DD;
  border-radius: 8px;
  background-color: #DAB897;
  padding: 9px;
  text-decoration: none;
  margin: 5px;
}

nav a.router-link-exact-active {
  color: #fc6203 ;
}
header {
  padding: 30px;
}
.button:hover{
        color:#fc6203;
        cursor: pointer;
    }
nav a:hover{
    color:#fc6203;
    cursor: pointer;
}

</style>
