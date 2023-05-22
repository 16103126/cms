<div class="preloader">
    <div class="loader">
        <div></div>
      </div>
      <svg>
        <defs>
          <filter id="goo">
            <fegaussianblur in="SourceGraphic" stddeviation="15" result="blur"></fegaussianblur>
            <fecolormatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 30 -10" result="goo"></fecolormatrix>
            <feblend in="SourceGraphic" in2="goo"></feblend>
          </filter>
        </defs>
      </svg>
</div>