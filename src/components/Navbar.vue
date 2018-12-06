<template>
  <header class="Header">
    <div class="Page-container">
      <div class="Header-container">
        <router-link to="/">
          <img class="Header-logo" src="src/Assets/Images/washi-logo.svg">
        </router-link>
        <nav class="PageNav">
          <ul class="PageNav-list">
            <li class="PageNav-Link">
              <router-link to="/boka">Boka tvättid</router-link>
            </li>
            <li class="PageNav-Link">
              <router-link to="/hjalp">Hjälp</router-link>
            </li>
            <li class="PageNav-Link">
              <router-link to="/regler">Regler</router-link>
            </li>
            <li class="PageNav-Link">
              <router-link to="/tvattrad">Tvättråd</router-link>
            </li>
            <li class="PageNav-Link">Logga ut</li>
          </ul>
        </nav>
      </div>
    </div>
  </header>
</template>