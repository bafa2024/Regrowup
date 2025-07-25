
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8"/>
    <meta name="robots" content="noindex, nofollow"/>

    <title>403 Forbidden</title>
    <style type="text/css">
            html,
      body {
        height: 100%;
      }

      body {
        margin: 0;
      }

      .error {
        display: flex;
        flex-direction: column;
        align-items: center;
        overflow: hidden;
        margin: 0;
      }

      .error-body {
        display: flex;
        justify-content: center;
        flex-grow: 1;
        width: 100%;
        background: #fff;
        text-align: center;
      }

      .error-body-inner {
        position: relative;
        max-width: 30rem;
        margin: 0 1rem;
      }

      .error-body-reason,
      .error-body-message {
        text-align: left;
      }

      @media (max-width: 690px) {
        .error-code {
          font-size: 20vw;
        }

        .error-logo {
          width: 30vw;
        }
      }
    </style>
  </head>

  <body>
    <div class="error">
      <div class="error-body">
        <div class="error-body-inner">
          <svg class="error-logo" height="92" width="122" xmlns="http://www.w3.org/2000/svg">
            <title>Freelancer Logo Mark</title>
            <path d="M56.897 0l6.624 9.29L97.036 0M22.075 72.333l18.13-17.725-10.912-11.71M54.152 0l-9.69 8.738 16.298.608M16.482 0l3.48 7.133 19.18 1.195M26.75 36.986l14.17-26.434L-.23 8.328M28.4 38.662L41.785 53.04 56.55 38.567l4.582-26.957-17.993-.918" fill="#29B2FE"/>
          </svg>

          <h1>403 Forbidden</h1>
          <h2 class="error-body-reason">What happened?</h2>
          <p class="error-body-message">Our systems have detected unusual activity coming from your computer network and have temporarily blocked this web request.</p>
          <h2 class="error-body-reason">What can I do?</h2>
          <ol class="error-body-message">
            <li>To submit a request to regain access, please complete the CAPTCHA below:</li>
          </ol>

          <div style="width: 50%">
            <form method="POST" action="">
              <div class="g-recaptcha" data-sitekey="6LfbZSwUAAAAAML3MH1FekxQqsSf6EdtuhOPts3z"></div>
              <input type="submit" class="btn btn-success" value="Verify"/>
            </form>
          </div>

          <script src="https://www.google.com/recaptcha/api.js" async defer></script>

          <p><small>Request ID: cf7c5ce9d86d14ce606cabe425938cc6</small></p>
        </div>
      </div>
    </div>
  </body>
</html>
