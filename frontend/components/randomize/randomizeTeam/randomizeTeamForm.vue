<template>
    <div class="container">
        <div v-if="randomized == 0">
            <div class="row">
                <div class="section-heading text-center w-75 mx-auto mb-3">
                    <h2 class="heading-line">Losowanie drużyn</h2>
                    <p class="lead text-muted">Nazwy drużyn i graczy muszą być unikalne</p>
                </div>
            </div>
            <div class="row" v-if="error.unequal">
                <div class="col-lg-12">
                    <div class="alert alert-primary" role="alert">
                        Liczba graczy musi być równa liczbie drużyn lub większa.
                    </div>  
                </div>
            </div>
            <div class="row" v-if="error.emptyField">
                <div class="col-lg-12">
                    <div class="alert alert-primary" role="alert">
                    Wypełnij wszystkie pola.
                    </div>  
                </div>
            </div>
            <div class="row" v-if="error.nonunique">
                <div class="col-lg-12">
                    <div class="alert alert-primary" role="alert">
                    Nazwy muszą drużyn i graczy muszą być unikalne.
                    </div>  
                </div>
            </div>
            <div class="row">
    
                <div class="col-lg-6">
                    <div class="card shadow mb-5 align-items-center">
                        <div class="card-body">
                            <h5 class="mb-3 text-center">Nazwa drużyny nr 1</h5>
                            <input class="mt-3" v-model="firstTeam" value="">
                            <div class="mt-4" v-for="(team, index2) in teams" :key="team+index2">
                                <h5 class="mb-3 text-center">Nazwa drużyny nr {{index2+2}}</h5>
                                <input class="mt-3" v-model="team.value" :key="index2">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <div class="btn-group">
                                    <button @click.prevent="addTeam" class="btn btn-rounded btn-alternate">Dodaj drużynę</button>
                                    <button v-if="teams.length > 0" @click.prevent="deleteTeam" class="btn btn-rounded btn-alternate">Usuń drużynę</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>           
                <div class="col-lg-6">
                    <div class="card shadow mb-3 align-items-center">
                        <div class="card-body">
                            <h5 class="mb-3 text-center">Zawodnik nr 1</h5>
                            <input class="mt-3" v-model="firstPlayer" value="">
                            <div class="mt-4" v-for="(player, index) in players" :key="player+index">
                                <h5 class="mb-3 text-center">Zawodnik nr {{index+2}}</h5>
                                <input class="mt-3" v-model="player.value" :key="index">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <div class="btn-group">
                                    <button @click.prevent="addPlayer" class="btn btn-rounded btn-alternate">Dodaj zawodnika</button>
                                    <button v-if="players.length > 0" @click.prevent="deletePlayer" class="btn btn-rounded btn-alternate">Usuń zawodnika</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <button @click.prevent="validation" class="btn btn-rounded btn-primary text-contrast">Losuj drużyny</button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="randomized == 1">
            <div class="row">
                <div class="section-heading text-center w-75 mx-auto mb-3">
                    <h2 class="heading-line">Losowanie drużyn</h2>
                    <p class="lead text-muted">Wylosowane drużyny</p>
                </div>
                <div class="col-lg-12">
                    <div class="row" v-for="(key,value) in randomizedTeams" :key="key">
                        <div class="col-lg-12">
                            <div class="card shadow mb-5 align-items-center">
                                <div class="card-body">
                                    <h5 class="mb-3 text-center">{{value}}</h5>
                                    <ul class="list-group text-center mb-2">                       
                                        <li class="list-group-item" v-for="player in key" :key="player">{{player}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>           
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <div class="btn-group mb-5">
                            <button @click.prevent="back" class="btn btn-rounded btn-alternate">Wróć</button>
                            <button @click.prevent="reset" class="btn btn-rounded btn-primary text-contrast">Losuj od nowa</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'randomizeTeamForm',

    components: {

    },

    data() {
        return {
            firstPlayer: "",
            firstTeam: "",
            players:[],
            teams:[],
            randomized: 0,
            randomizedTeams: [],
            teamsWithFirstTeam: [],
            playersWithFirstPlayer: [],
            error:{
                unequal: 0,
                emptyField: 0,
                nonunique: 0
            }
        }
    },

    methods: {
        addPlayer: function () {
            this.players.push({ value: '' });
        },

        deletePlayer: function () {
            this.players.pop();
        },
        
        addTeam: function () {
            this.teams.push({ value: '' });
        },

        deleteTeam: function () {
            this.teams.pop();
        },

        checkIfArrayIsUnique: function(myArray) {
            return myArray.length === new Set(myArray).size;
        },

        validation: function(){
            
            this.error.unequal = 0;
            this.error.emptyField = 0;

            this.teamsWithFirstTeam = this.teams.slice();
            this.playersWithFirstPlayer = this.players.slice();

            this.playersWithFirstPlayer.unshift({"value": this.firstPlayer});
            this.teamsWithFirstTeam.unshift({"value": this.firstTeam})


            for(var i = 0; i < this.playersWithFirstPlayer.length; i++) {
                if(!this.playersWithFirstPlayer[i].value){
                    this.error.emptyField = 1;
                    return;
                }
            }

            for(var i = 0; i < this.teamsWithFirstTeam.length; i++) {
                if(!this.teamsWithFirstTeam[i].value){
                    this.error.emptyField = 1;
                    return;
                }
            }
            
            if(this.teamsWithFirstTeam.length > this.playersWithFirstPlayer.length){
                this.error.unequal = 1;
            }
            else{
                this.randomizeTeam();
            }
        },

        randomizeTeam: function(){

            axios
                .post(process.env.LARAVEL_ENDPOINT+'/api/randomizeTeam', {teams: this.teamsWithFirstTeam, players: this.playersWithFirstPlayer})
                .then((response) => {
                    console.log(response);
                    this.randomizedTeams = response.data[0];
                    this.randomized = 1;
                })
                .catch((e)=>{
                    console.log(e.response);
                    this.$forceUpdate();
                })
        },
        back: function () {
            this.randomized = 0;
        },

        reset: function (){
            this.firstPlayer = "",
            this.firstTeam = "",
            this.players = [],
            this.teams = [],
            this.randomized = 0,
            this.randomizedTeams = []
        }
    }
}
</script>

<style>

</style>