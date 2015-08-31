/*
 * Useful javascript events
 */

// Triggered when a map is ready
jeo.mapReady(function(map) {
  // console.log(map);
});

// Triggered when a group is ready
jeo.groupReady(function(group) {
  // console.log(group);
});

// Triggered when the user changed the map being displayed on the group
jeo.groupChanged(function(group, prevMap) {
  // console.log(group, prevMap);
});

// Triggered when the map range slider filter changes
// jeo.rangeSliderFiltered(function(markers, map) {
//   console.log(markers, map);
// });
