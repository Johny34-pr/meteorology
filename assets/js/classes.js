class Operator {
  // site-user
  constructor(name, email, location_id, reg_time) {
    this.name = name;
    this.email = email;
    this.location_id = location_id;
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