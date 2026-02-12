<?php get_header(); ?>

<main class="main">

  <div class="neverMiss">
    <h1>Never miss anything</h1>
    <div class="buttons">
      <button class="button1">Trial</button>
      <button class="button2">Buy</button>
    </div>
  </div>
  <div class="ready">
    <div class="describe">
      <h2>Prometheus ready</h2>
      <p>Prometheus4AIX is a native Prometheus exporter for AIX: it is fully compliant with Prometheus. No need wrapper
        nor gateway. Install it, start it, and you get your metrics into your Prometheus server.</p>
    </div>
    <div class="describe">
      <h2>No extra requirement</h2>
      <p>No need Go or any painful package installation: Prometheus4AIX embeds the required dependencies and deliver
        them in the fileset. You only need an AIX 7 operating system. Install it in juste one command. No internet
        access needed.</p>
    </div>
    <div class="describe">
      <h2>Custom parameters</h2>
      <p>You can enable or disable group of metrics if you do not need any details for example. You also can change the
        sampling rate by default, 30s, the default communication port 9100/tcp which can be commonly used by other
        software such as a database. You keep full control.</p>
    </div>
  </div>
  <div class="tryitnow">
    <h2>Try it Now. 30 days free Trial</h2>
    <button class="button1">Download</button>
  </div>
  <div class="resiliency">
    <div class="title">
      <h2>Resiliency for AIX systems</h2>
      <i>Unleash the power of your profesional systems. Reduce downtimes. Faster solve incidents.</i>
    </div>
    <img src="<?php echo get_stylesheet_directory_uri()?>/images/resiliency-bg.png" alt="Resiliency charts" />
    <p>
      Your systems metrics are now ready to be visualized into modern dashboards using Grafana: select the time range,
      zoom in, zoom out, select only
      required series of data, thanks to the Grafana data source for Prometheus.<br>Fine search data, filter and zoom
      your charts for details, dig for
      unexpected system behaviors or whatever you are looking for. This is all available in a modern custom set of
      dashboards, just right now.
    </p>
  </div>
  <div class="getalerts">
    <div class="photo"></div>
      <h2>Get real time alerts</h2>
      <p>
        Visualising is nice, but getting real time alerts is better. Using your favorite alert manager, such as the
        Prometheus one, or Grafana one, you get alerts when something turns wrong on your system. </br>
        Create simple and efficient rules applying to all your AIX systems, including VIO servers. Use Prometheus tags
        to provide details informations into your alert messages.</br>
        Prometheus4Aix exporter include specific tags depending on the monitored resource. For example: lpar name,
        pseries name, processor reference and so on. </br>All alerts channels are available: emails, Discord, Slack,
        Telegram, Line, Webhook and many more.
      </p>
      <button class="button3">Download</button>
    </div>

    <div class="production">
      <h2>Production ready</h2>
      <p class="text1"> Ten of thousands of metrics are monitored each minutes, on different versions of the AIX system, and the whole exporter footprint is insignificant for usual CPU, RAM and I/O resources.<br/><br/> Prometheus4Aix supports all versions of the 7.x family for pSeries systems: 7.1, 7.2 and 7.3. It also supports VIO servers based on AIX 7.  </p>
      <p class="text2"> Prometheus4Aix software runs extensively for months on huge and also small pSeries systems: from a 0.1 EC and 10GB LPAR to 256 VCPU and 512 GB RAM’s one, we are truly confident Prometheus4Aix will run smoothly on your systems as well.  </p>
    </div>

    <div class="kiss">
      <h2>How to KISS install</h2>
      <p>Keep it simple is our mantra</p>
      <picture>
        <source srcset="<?php echo get_stylesheet_directory_uri()?>/images/route960.jpg" media="(max-width: 960px)">
        <source srcset="<?php echo get_stylesheet_directory_uri()?>/images/route768.jpg" media="(max-width: 768px)">
        <source srcset="<?php echo get_stylesheet_directory_uri()?>/images/route480.jpg" media="(max-width: 480px)">
        <source srcset="<?php echo get_stylesheet_directory_uri()?>/images/route360.jpg" media="(max-width: 360px)">
        <source srcset="<?php echo get_stylesheet_directory_uri()?>/images/route1440.jpg">
        <img src="<?php echo get_stylesheet_directory_uri()?>/images/route1440.jpg" alt="KISS route chart" />
      </picture>
    </div>

  </div>
</main>

<?php get_footer(); ?>