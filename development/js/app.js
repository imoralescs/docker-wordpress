import {Example} from './modules/example.js';

var objects = {
	name : "Sed Accumsan",
	description : "Pellentesque eget nulla a mi commodo vestibulum."
};

var example = new Example(objects);

console.log(example.getName());
