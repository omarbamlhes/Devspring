/**
 * @file
 * Dev behaviors.
 */
(function (Drupal) {

  'use strict';

  Drupal.behaviors.dev = {
    attach (context, settings) {

      console.log('It works!');

    }
  };

} (Drupal));

  // Dark Mode
  const darkModeBtn = document.getElementById('dark-mode-toggle');
  const body = document.body;

  darkModeBtn.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
  });

  // Opinion Block
  const feedbackBlock = document.querySelector('.feedback-block');
  const feedbackButtons = document.querySelectorAll('.feedback-buttons button');
  const feedbackMessage = document.querySelector('.feedback-message');

  feedbackButtons.forEach(button => {
    button.addEventListener('click', () => {
      feedbackMessage.textContent = button.textContent;
    });
  });