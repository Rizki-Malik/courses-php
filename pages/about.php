
<section class="about">
    <div>
        <h1 class="greeting" style="text-align: center;">About, <span class="typeText"></span></h1>
        <p class="description" style="margin: 60px;">Have you ever dreamt of bringing your ideas to life through the power of code? The world of programming is a vast and exciting landscape, where logic and creativity converge to build the digital tools and experiences that shape our lives. From the websites you browse to the games you play, programming is the invisible language that makes them tick.</p>
        <p class="description" style="margin: 60px;">In a programming course, you'll embark on a thrilling adventure, unlocking the secrets of this language. You'll start with the fundamentals, learning how to write clear and concise instructions for computers to follow. As you progress, you'll delve deeper into problem-solving techniques, data manipulation, and building complex programs. But programming is more than just writing code; it's about unlocking a new way of thinking. You'll develop analytical skills, learn to break down challenges into manageable steps, and foster a growth mindset that embraces continuous learning.</p>
        <p class="description" style="margin: 60px;">Join with me on this journey of discovery and let your imagination soar with the possibilities that await.  Together, we can turn your programming aspirations into reality, one line of code at a time. We can build amazing things, solve problems in innovative ways, and push the boundaries of what's possible. Are you ready to begin?</p>
        <p class="description" style="margin: 60px;">
The world of programming is a vast and exciting landscape, where logic and creativity converge to build the digital tools and experiences that shape our lives. From the websites you browse to the games you play, programming is the invisible language that makes them tick.</p>
    </div>
</section>

<script>
var typeText = document.querySelector(".typeText")
var textToBeTyped = "Course Programming"
var index = 0, isAdding = true

function playAnim() {
  setTimeout(function () {
    typeText.innerText = textToBeTyped.slice(0, index)
    if (isAdding) {
      if (index > textToBeTyped.length) {
        isAdding = false
        setTimeout( function () {
          playAnim()
        }, 2000)
        return
      } else {
        index++
      }
    } else {
      if (index === 0) {
        isAdding = true
      } else {
        index--
      }
    }
    playAnim()
  }, 120)
}
playAnim()
</script>