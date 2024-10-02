/*************************************
Editor SCSS
**************************************/

import "./sass/editor/_editor.scss";

wp.blocks.registerBlockType('flimedia/block', {
    title: 'Fli Media Blocks',
    icon: flimediaIcon, // Use the custom icon from icons.js
    category: 'flimedia-category', // Assign to the custom block category
    edit: function() {
        return wp.element.createElement('div', null, 'Custom Block Edit View');
    },
    save: function() {
        return wp.element.createElement('div', null, 'Custom Block Save View');
    }
});