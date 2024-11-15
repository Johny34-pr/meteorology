class User {
  // site-user
  constructor(id, name, email, reg, rank, stat) { //User id, full name, email, registration date, rank, status
    this.id = id;
    this.name = name;
    this.email = email;
    this.reg = reg;
    this.rank = rank;
    this.stat = stat;
  }
}

class Game {
  //Organized game

  constructor(id, name, location, tournament_type, play_it_by, group_count, player_count, apply_start, apply_end, game_day, game_type, comment = null) { //id, competition name, tournament type, play it by players, group number, player number in groups, apply start date, apply end date, game type, comment
    this.id = id;
    this.name = name;
    this.location = location;
    this.tournament_type = tournament_type;
    this.play_it_by = play_it_by;
    this.group_count = group_count;
    this.player_count = player_count;
    this.apply_start = apply_start;
    this.apply_end = apply_end;
    this.game_day = game_day;
    this.game_type = game_type;
    this.comment = comment;
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