<h1>Some queries related to BnW.</h1>
<h2>Here some queries are referenced fro better use in view and user simplicity</h2>
<p>First of all create a controller as your wish for view.</p>
<p>Load viewmodel, dbmodel, dbsetting and model1 in your constructor as :</p>
<pre><code>public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('viewmodel');
        $this->load->model('dbmodel');
        $this->load->model('dbsetting');
        $this->load->model('model1');
    }</code></pre>

<p>To load the header meta data like title, site url, contents use </p>
<pre><code>
  $data['meta'] = $this->dbsetting->get_meta_data();
    </code></pre>

<p>To load the header header description use </p>
<pre><code>
   $data['headerdescription']= $this->viewmodel->get_header_description();
    </code></pre>

<p>To load the header logo use </p>
<pre><code>
    $data['headerlogo']= $this->viewmodel->get_header_logo();
    </code></pre>

<p>To load the header title use </p>
<pre><code>
     $data['headertitle']= $this->viewmodel->get_header_title();
    </code></pre>

<p>To load the slide use </p>
<pre><code>
    $data['slidequery'] = $this->viewmodel->get_slider();
    </code></pre>

<p>To load the posts use </p>
<pre><code>
    $data['allpostquery'] = $this->viewmodel->get_all_post();
    </code></pre>

<p>To load the gadgets use </p>
<pre><code>
    $data['gadget'] = $this->model1->get_gaget(); 
    </code></pre>
