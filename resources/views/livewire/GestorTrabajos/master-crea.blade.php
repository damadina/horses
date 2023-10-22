<div>
    <div class=" mx-4 mt-4 text-cyan-500">

        <ul id="tabs" class="inline-flex p-2 w-full border-b [&>*]:border-cyan-600 border-cyan-600">
          <li class="p-2 cursor-pointer rounded-t-md border-t border-l border-r -mb-2 bg-white active" tab-to="t1">
            Lunes
          </li>
          <li class="p-2 cursor-pointer" tab-to="t2">
            Martes
          </li>
          <li class="p-2 cursor-pointer" tab-to="t3">
            Miércoles
          </li>
          <li class="p-2 cursor-pointer" tab-to="t4">
            Jueves
          </li>
          <li class="p-2 cursor-pointer" tab-to="t5">
            Viernes
          </li>
          <li class="p-2 cursor-pointer" tab-to="t6">
            Sábado
          </li>
          <li class="p-2 cursor-pointer" tab-to="t7">
            Domingo
          </li>
        </ul>

        <div id="tab-contents">
          <div class="p-4 active" tab-id="t1">
            Lunes
          </div>
          <div class="p-4 hidden" tab-id="t2">
            Martes
          </div>
          <div class="p-4 hidden" tab-id="t3">
            Miercoles
          </div>
          <div class="p-4 hidden" tab-id="t4">
            Jueves
          </div>
          <div class="p-4 hidden" tab-id="t5">
            Viernes
          </div>
          <div class="p-4 hidden" tab-id="t6">
            Sabado
          </div>
          <div class="p-4 hidden" tab-id="t7">
            Domingo
          </div>

        </div>
    </div>
    @push('scripts')
        <script>
            document.querySelectorAll('#tabs [tab-to]').forEach(function(item) {
                    item.addEventListener('click', function(e) {
                    let link = this.getAttribute('tab-to');
                    let active_content = document.querySelector('#tab-contents .active');
                    let tab_el = document.querySelector('#tab-contents [tab-id="' + link + '"]');
                    let active_tab = document.querySelector('#tabs .active')

                    active_content.classList.remove("active");
                    active_content.classList.add("hidden");

                    tab_el.classList.remove("hidden");
                    tab_el.classList.add("active");

                    active_tab.classList.remove("active", "rounded-t-md", "border-t", "border-l", "border-r", "-mb-2", "bg-white");
                    this.classList.add("active", "rounded-t-md", "border-t", "border-l", "border-r", "-mb-2", "bg-white");
                });
            });
        </script>
    @endpush
</div>
