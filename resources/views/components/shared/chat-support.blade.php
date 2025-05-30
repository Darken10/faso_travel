<div>
    <div class="h-screen overflow-hidden flex items-center justify-center" style="background: #edf2f7;">
        <style>
        .chat-services{
          transition: .5s;
          max-height: 0;
        }
        .chat-services.expand{
          max-height: 50px;
        }
        .message {
          max-width: 250px;
        }

        .chat-modal{
          transition: .5s;
          opacity: 0;
          transform: translateX(500px);
        }

        .chat-modal.show{
          opacity: 1;
          transform: translateX(0);
        }

        @keyframes animateModal {
          from{
            transform: translateX(200px) opacity(0);
          }
          to{
            transform: translateX(0) opacity(1);
          }
        }
      </style>

    <div class="fixed bottom-0 right-0 flex flex-col items-end ml-6 w-2">
        <div class="chat-modal   mr-5 flex flex-col mb-5 shadow-lg sm:w-1/2 md:w-1/3 lg:w-1/4">
          <!-- close button -->
          <div class="close-chat bg-red-500 hover:bg-red-600 text-white mb-1 w-10 flex justify-center items-center px-2 py-1 rounded self-end cursor-pointer">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
              <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
            </svg>
          </div>
          <!-- admin profile -->
          <div class="flex justify-between items-center text-white p-2 bg-green-500 border shadow-lg mr-5 w-full">
            <div class="flex items-center">
              <img src="{{ asset('images/faces/face10.jpg') }}" alt="picture" class="rounded-full w-8 h-8 mr-1">
              <h2 class="font-semibold tracking-wider">Darken</h2>
            </div>
            <div class="flex items-center justify-center">
              <small class="mr-1">online</small>
              <div class="rounded-full w-2 h-2 bg-white"></div>
            </div>
          </div>
          <!-- chats -->
          <div class="flex flex-col bg-gray-200 px-2 chat-services expand overflow-auto">
            <div class="chat bg-white text-gray-700 p-2 self-start my-2 rounded-md shadow mr-3">
                Comment puis-je vous aider ?
            </div>
            <div class="message bg-green-500 text-white p-2 self-end my-2 rounded-md shadow ml-3">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti, ratione!
            </div>
            <div class="message bg-green-500 text-white p-2 self-end my-2 rounded-md shadow ml-3">
              Lorem, ipsum.
            </div>
            <div class="message bg-white text-gray-700 p-2 self-start my-2 rounded-md shadow mr-3">
              Lorem ipsum dolor sit amet.
            </div>
            <div class="message bg-green-500 text-white p-2 self-end my-2 rounded-md shadow ml-3">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, quod.
            </div>
            <div class="message bg-white text-gray-700 p-2 self-start my-2 rounded-md shadow mr-3">
              Lorem, ipsum dolor.
            </div>

          </div>
          <!-- send message -->
          <div class="relative bg-white">
            <form action="#" method="post">
                <input type="text" name="message" placeholder="Écrivez votre message"
                    class="pl-4 pr-16 py-2 border border-green-500 focus:outline-none w-full">
                <button class="absolute right-0 bottom-0 text-green-600 bg-white hover:text-green-500 m-1 px-3 py-1 w-auto transistion-color duration-100 focus:outline-none">Envoyer</button>
            </form>
          </div>
        </div>
        <div class="show-chat show mx-10 mb-6 mt-4 text-green-500 hover:text-green-600 flex justify-center items-center cursor-pointer ">
          <svg width="4em" height="4em" viewBox="0 0 16 16" class="bi bi-chat-text-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM4.5 5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4z"/>
          </svg>
        </div>
      </div>

      <script>
        const chatModal = document.querySelector('.chat-modal');
        const chatServices = document.querySelector('.chat-services');

        const showChat = document.querySelector('.show-chat');
        const closeChat = document.querySelector('.close-chat');

        showChat.addEventListener('click', function (){
          chatModal.classList.add('show')
          showChat.classList.add('hidden')
          setTimeout(() => {
            chatServices.classList.add('expand')
          }, 500);
        });
        closeChat.addEventListener('click',function () {
          setTimeout(() => {
            showChat.classList.remove('hidden')
          }, 820);
          chatServices.classList.remove('expand')
          setTimeout(() => {
          chatModal.classList.remove('show')
          }, 500);
        });
      </script>
    </div>
</div>
