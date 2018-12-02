Vue.component('education-item', {
  template: '\
            <li>\
              {{title}}\
            </li>\
            ',
  props: ['title']
})


const app = new Vue({
  el: '#app',
  data: {
    show: 1,
    countEdu: 1,
    countExp: 1,
    countComp: 1,
    countOth: 1,
    educations: [{education:'',placeEdu:'',institute:'',fromEdu:'',untilEdu:'',informationEdu:''}],
    experiences: [{function:'',placeExp:'',employer:'',fromExp:'',untilExp:'',informationExp:''}],
    computerskills: [{computerskill:'',computerlevel:''}],
    otherskills: [{otherskill:'',otherlevel:''}]

  },
  methods: {
    addEducation: function () {
      this.educations.push({education:'',placeEdu:'',institute:'',fromEdu:'',untilEdu:'',informationEdu:''});
    },
    deleteEducation () {
      this.educations.pop({education:'',placeEdu:'',institute:'',fromEdu:'',untilEdu:'',informationEdu:''});
    },
    addExperience: function () {
      this.experiences.push({function:'',placeExp:'',employer:'',fromExp:'',untilExp:'',informationExp:''});
    },
    deleteExperience () {
      this.experiences.pop({function:'',placeExp:'',employer:'',fromExp:'',untilExp:'',informationExp:''});
    },
    addComputerskill: function () {
      this.computerskills.push({computerskill:'',computerlevel:''});
    },
    deleteComputerskill () {
      this.computerskills.pop({computerskill:'',computerlevel:''});
    },
    addOtherskill: function () {
      this.otherskills.push({otherskill:'',otherlevel:''});
    },
    deleteOtherskill () {
      this.otherskills.pop({otherskill:'',otherrlevel:''});
    },
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