window.timeFormat = function (input) {
  return new Date(input * 1000)
    .toISOString()
    .substring(11, 19)
    .replace(/^0(?:0:0?)?/, '');
};

window.bufferedPct = function (buffered, duration) {
  return buffered && buffered.length > 0 && buffered.end && duration ? ((buffered.end(0) / duration) * 100).toFixed(2) : 0;
};
