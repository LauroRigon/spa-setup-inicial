<template>
  <header>
    <nav class="top-nav blue darken-2">
      <div class="container">
        <a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only"><i class="material-icons">menu</i></a>
        <div class="nav-wrapper"><a class="page-title">Menu de cima</a></div>
      </div>
    </nav>
      <ul id="nav-mobile" class="side-nav fixed">
        <li class="no-padding">
          <ul class="collapsible collapsible-accordion">
            <li class="bold" v-for="(menu, index) in menus" :key="index">
            <a class="collapsible-header waves-effect waves" v-if="menu.dropdown"><i class="material-icons">{{ menu.icon }}</i>{{ menu.label }}</a>
              <div class="collapsible-body">
                <ul>
                  <li v-for="(subMenu, index) in menu.subMenus" :key="index"><router-link :to="subMenu.uri" class="waves-effect waves"><i class="material-icons">{{ subMenu.icon }}</i>{{ subMenu.label }}</router-link></li>
                </ul>
              </div>
            <router-link :to="menu.uri" v-if="!menu.dropdown" tag="li">
              <a class="waves-effect waves"><i class="material-icons">{{ menu.icon }}</i>{{ menu.label }}</a>
            </router-link>
            </li>
          </ul>
        </li>
      </ul>
  </header>
</template>

<script>
import menus from '../../../configs/menus.js'

  export default {
    data() {
      return {
        menus: menus
      }
    },

    mounted() {
      $( document ).ready(function() {
        $(".button-collapse").sideNav();
      });
    }
  }
</script>
