window.timeFormat = function (input) {
  return new Date(input * 1000)
    .toISOString()
    .substring(11, 19)
    .replace(/^0(?:0:0?)?/, '');
};
