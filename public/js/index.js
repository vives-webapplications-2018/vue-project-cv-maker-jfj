/*jshint esversion: 6 */

const app = new Vue({
  el: '#app',
  data: {
    show: 1,
    countEdu: 1,
    countExp: 1,
    countComp: 1,
    countOth: 1
  },
  methods: {
    incrementStep() {
      this.show++;
    },
    decrementStep() {
      this.show--;
    },
    incrementCountEdu() {
      this.countEdu++;
    },
    decrementCountEdu() {
      this.countEdu--;
    },
    incrementCountExp() {
      this.countExp++;
    },
    decrementCountExp() {
      this.countExp--;
    },
    incrementCountComp() {
      this.countComp++;
    },
    decrementCountComp() {
      this.countComp--;
    },
    incrementCountOth() {
      this.countOth++;
    },
    decrementCountOth() {
      this.countOth--;
    }

  }
});