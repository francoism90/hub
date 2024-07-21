window.timeFormat = (input = 0) => new Date(input * 1000)
    .toISOString()
    .substring(11, 19)
    .replace(/^0(?:0:0?)?/, "");

window.bufferedPct = (buffered = NaN, duration = NaN) => buffered && buffered.end && duration
  ? ((buffered.end / duration) * 100).toFixed(2)
  : 0;
