const app = new Vue({
  el: '#app',
  data: {
    show: 1,
    educations: [{education:'',placeEdu:'',institute:'',fromEdu:'',untilEdu:'',informationEdu:''}],
    experiences: [{function:'',placeExp:'',employer:'',fromExp:'',untilExp:'',informationExp:''}],
    computerskills: [{computerskill:'',computerlevel:''}],
    otherskills: [{otherskill:'',otherlevel:''}],
    githubjson:'',
    githubUsernameInput:'',
    githubTokenInput:'',

  },
  updated: function () {
    this.$nextTick(function () {
        if(this.show===6){
          axios.post('/getgithub', {
            githubUsername: this.githubUsernameInput,
            githubToken: this.githubTokenInput
          })
          .then(function (response) {
            githubjson = response.data;
            console.log(githubjson);
            app.setGithubJson(githubjson);
          })
          .catch(function (error) {
            console.log(error);
          });
        }  
    })
  },
  methods: {
    setGithubJson: function (json) {
      this.githubjson=json;
    },
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
    }
  }
});