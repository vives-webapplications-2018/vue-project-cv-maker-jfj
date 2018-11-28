/*jshint esversion: 6 */

const app = new Vue({
  el: '#app',
  data: {
    show: 1,
    count: 3
  },
  methods: {
    incrementStep() {
      this.show++;
    },
    decrementStep() {
      this.show--;
    }

  }
});