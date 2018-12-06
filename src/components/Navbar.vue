<template>
  <header class="Header">
    <div class="Page-container">
      <div class="Header-container">
        <router-link to="/">
          <img class="Header-logo" src="src/Assets/Images/washi-logo.svg">
        </router-link>
        <nav class="PageNav">
          <ul class="PageNav-list">
            <li>
              <router-link class="PageNav-Link" to="/boka">Boka tvättid</router-link>
            </li>
            <li>
              <router-link class="PageNav-Link" to="/hjalp">Hjälp</router-link>
            </li>
            <li>
              <router-link class="PageNav-Link" to="/regler">Regler</router-link>
            </li>
            <li>
              <router-link class="PageNav-Link" to="/tvattrad">Tvättråd</router-link>
            </li>
            <li class="PageNav-Link">Logga ut</li>
          </ul>
        </nav>
      </div>
    </div>
  </header>
</template>