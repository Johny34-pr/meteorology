class Operator {
  // site-user
  constructor(name, email, station_name, reg_time) {
    this.name = name;
    this.email = email;
    this.station_name = station_name;
    this.reg_time = reg_time;
  }
}

class Measure {
  //Measurement

  constructor(operator, instrument, timestamp, value = null, unit = null, station = null) {
    this.operator = operator;
    this.instrument = instrument;
    this.timestamp = timestamp;
    this.value = value;
    this.unit = unit;
    this.station = station;
  }
}

class Player {
  //Game player
  constructor(id, playerName, playerClub, playerClass) {  //Player full name, player Club, player class
    this.id = id;
    this.playerName = playerName;
    this.playerClub = playerClub;
    this.playerClass = playerClass;
  }
}

class Apply {
  constructor(playerId, player2Id, player3Id, player4Id, player5Id, phone, accommodation, competition, gameDay) {
    this.playerId = playerId;
    this.player2Id = player2Id;
    this.player3Id = player3Id;
    this.player4Id = player4Id;
    this.player5Id = player5Id;
    this.phone = phone;
    this.accommodation = accommodation;
    this.competition = competition;
    this.game_day = gameDay;
  }
}