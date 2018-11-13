var app = new Vue({
    el: '#app',
    data: {
      show: 1
    },
    methods: {
      incrementStep: function(){
        this.show++;
      }

    }
  })