<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* home.html */
class __TwigTemplate_069ca7147802f0cb7ddebd00321b29d2 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "/layout/master.html";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 3
        $context["title"] = "Halaman Utama - Twig";
        // line 1
        $this->parent = $this->loadTemplate("/layout/master.html", "home.html", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        yield "<div class=\"container\">
    <div class=\"page-inner\">
        <div class=\"page-header\">
            <h3 class=\"fw-bold mb-3\">Produtcs</h3>
        </div>
        <div class=\"row\">
            <div class=\"col-md-12\">
                <div class=\"card p-3\">
                    <div class=\"card-header\">
                        <div class=\"d-flex align-items-center\">
                            <h4 class=\"card-title\">Add Row</h4>
                            <button class=\"btn btn-primary btn-round ms-auto\" data-bs-toggle=\"modal\"
                                data-bs-target=\"#addRowModal\">
                                <i class=\"fa fa-plus\"></i>
                                Add Row
                            </button>
                        </div>
                    </div>
                    <div class=\"card-body\">

                        <!-- Modal Tambah -->
                        <div class=\"modal fade\" id=\"addRowModal\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
                            <div class=\"modal-dialog\" role=\"document\">
                                <div class=\"modal-content\">
                                    <div class=\"modal-header border-0\">
                                        <h5 class=\"modal-title\">
                                            <span class=\"fw-mediumbold\">New</span>
                                            <span class=\"fw-light\">Product</span>
                                        </h5>
                                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\"
                                            aria-label=\"Close\"></button>
                                    </div>
                                    <div class=\"modal-body\">
                                        <p class=\"small\">
                                            Create a new product using this form, make sure you fill them
                                            all
                                        </p>
                                        <form method=\"post\" action=\"proses-tambah-products.php\"
                                            enctype=\"multipart/form-data\">
                                            <div class=\"row\">
                                                <div class=\"col-sm-12\">
                                                    <div class=\"form-group form-group-default\">
                                                        <label for=\"name\">Name</label>
                                                        <input id=\"name\" type=\"text\" name=\"product_name\"
                                                            class=\"form-control\" placeholder=\"Enter product name\"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class=\"col-md-12\">
                                                    <div class=\"form-group form-group-default\">
                                                        <label for=\"category\">Category</label>
                                                        <select class=\"form-select p-2\" id=\"category\" name=\"category_id\"
                                                            required>
                                                            <option selected>Open this select products
                                                            </option>
                                                            <?php
                                                            \$sql = \"SELECT category_id, category_name FROM categories\";
                                                            \$result = mysqli_query(\$conn, \$sql);

                                                            if (mysqli_num_rows(\$result) > 0) {
                                                              // Loop melalui setiap baris hasil query
                                                            while (\$row = mysqli_fetch_assoc(\$result)) {
                                                            ?>
                                                            <option value=\"<?php echo (\$row['category_id']); ?>\">
                                                                <?php echo (\$row['category_name']); ?>
                                                            </option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class=\"col-md-12\">
                                                    <div class=\"form-group form-group-default\">
                                                        <label for=\"price\">Price per Kg</label>
                                                        <input id=\"Price\" type=\"number\" class=\"form-control\"
                                                            name=\"price_per_kg\" placeholder=\"Enter price per Kg\"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class=\"col-md-12\">
                                                    <div class=\"form-group form-group-default\">
                                                        <label for=\"description\">Description</label>
                                                        <textarea id=\"description\" class=\"form-control\"
                                                            name=\"description\" rows=\"3\"
                                                            placeholder=\"Enter product description\" required></textarea>
                                                    </div>
                                                </div>
                                                <div class=\"col-md-12\">
                                                    <div class=\"form-group form-group-default\">
                                                        <label for=\"stock\">Stock</label>
                                                        <input type=\"number\" id=\"stock\" class=\"form-control\"
                                                            name=\"stock\" placeholder=\"Enter product stock\"
                                                            required></input>
                                                    </div>
                                                </div>
                                                <div class=\"col-md-12\">
                                                    <div class=\"form-group form-group-default\">
                                                        <label for=\"image\">Product Image</label>
                                                        <input id=\"image\" type=\"file\" class=\"form-control-file\"
                                                            name=\"image\" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=\"modal-footer border-0\">
                                                <button type=\"submit\" class=\"btn btn-primary\" name=\"tambah\">
                                                    Add Product
                                                </button>
                                                <button type=\"button\" class=\"btn btn-secondary\"
                                                    data-bs-dismiss=\"modal\">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"table-responsive\">
                        <table id=\"basic-datatables\" class=\"display table table-striped table-hover\">
                            <thead class=\"table-light\">
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th style=\"width: 10%\">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                ";
        // line 139
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["products"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 140
            yield "                                <tr>
                                    <td>";
            // line 141
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 141), "html", null, true);
            yield "</td>
                                    <td><img class=\"img-fluid rounded\" src=\"../img/products/";
            // line 142
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "image", [], "any", false, false, false, 142), "html", null, true);
            yield "\" alt=\"\"
                                            style=\"width: 42px; height: 32px;\">
                                    </td>
                                    <td>";
            // line 145
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "product_name", [], "any", false, false, false, 145), "html", null, true);
            yield "</td>
                                    <td>";
            // line 146
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "category_name", [], "any", false, false, false, 146), "html", null, true);
            yield "</td>
                                    <td>";
            // line 147
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "price_per_kg", [], "any", false, false, false, 147), "html", null, true);
            yield "</td>
                                    <td>";
            // line 148
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "stock", [], "any", false, false, false, 148), "html", null, true);
            yield "</td>
                                    <td>
                                        <div class=\"form-button-action\">
                                            <button type=\"button\" class=\"btn btn-primary btn-lg\" data-bs-toggle=\"modal\"
                                                data-bs-target=\"#editModal";
            // line 152
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 152), "html", null, true);
            yield "\">
                                                <i class=\"fa fa-edit text-black\"></i>
                                            </button>

                                            <!-- Modal Edit -->
                                            <div class=\"modal fade\" id=\"editModal";
            // line 157
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 157), "html", null, true);
            yield "\" tabindex=\"-1\"
                                                aria-labelledby=\"staticBackdropLabel\" aria-hidden=\"true\">
                                                <div class=\"modal-dialog\" role=\"document\">
                                                    <div class=\"modal-content\">
                                                        <div class=\"modal-header border-0\">
                                                            <h5 class=\"modal-title\">
                                                                <span class=\"fw-mediumbold\">Edit</span>
                                                                <span class=\"fw-light\">Product</span>
                                                            </h5>
                                                            <button type=\"button\" class=\"btn-close\"
                                                                data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                                                        </div>
                                                        <div class=\"modal-body\">
                                                            <p class=\"small\">
                                                                Edit using this form, make
                                                                sure you fill them
                                                                all
                                                            </p>
                                                            <form method=\"post\" action=\"proses-edit-products.php\"
                                                                enctype=\"multipart/form-data\">
                                                                <div class=\"row\">
                                                                    <div class=\"col-sm-12\">
                                                                        <div class=\"form-group form-group-default\">
                                                                            <input type=\"hidden\" name=\"product_id\"
                                                                                value=\"";
            // line 181
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 181), "html", null, true);
            yield "\">
                                                                            <label for=\"name\">Name</label>
                                                                            <input id=\"name\" type=\"text\"
                                                                                name=\"product_name\" class=\"form-control\"
                                                                                placeholder=\"Enter product name\"
                                                                                required
                                                                                value=\"";
            // line 187
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "product_name", [], "any", false, false, false, 187), "html", null, true);
            yield "\">
                                                                        </div>
                                                                    </div>
                                                                    <div class=\"col-md-12\">
                                                                        <div class=\"form-group form-group-default\">
                                                                            <label for=\"category\">Category</label>
                                                                            <select class=\"form-select p-2\"
                                                                                id=\"category\" name=\"category_id\"
                                                                                required>
                                                                                <option selected
                                                                                    value=\"";
            // line 197
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "category_id", [], "any", false, false, false, 197), "html", null, true);
            yield "\">
                                                                                    ";
            // line 198
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "category_name", [], "any", false, false, false, 198), "html", null, true);
            yield "
                                                                                </option>
                                                                                <?php
                                                                                  \$sql = \"SELECT category_id, category_name FROM categories\";
                                                                                  \$result = mysqli_query(\$conn, \$sql);

                                                                                  if (mysqli_num_rows(\$result) > 0) {
                                                                                    // Loop melalui setiap baris hasil query
                                                                                  while (\$row = mysqli_fetch_assoc(\$result)) {
                                                                                  ?>
                                                                                <option
                                                                                    value=\"<?php echo (\$row['category_id']); ?>\">
                                                                                    <?php echo (\$row['category_name']); ?>
                                                                                </option>
                                                                                <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class=\"col-md-12\">
                                                                        <div class=\"form-group form-group-default\">
                                                                            <label for=\"price\">Price per
                                                                                Kg</label>
                                                                            <input id=\"Price\" type=\"number\"
                                                                                class=\"form-control\" name=\"price_per_kg\"
                                                                                placeholder=\"Enter price per Kg\"
                                                                                value=\"";
            // line 226
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "price_per_kg", [], "any", false, false, false, 226), "html", null, true);
            yield "\"
                                                                                required>
                                                                        </div>
                                                                    </div>
                                                                    <div class=\"col-md-12\">
                                                                        <div class=\"form-group form-group-default\">
                                                                            <label for=\"description\">Description</label>
                                                                            <textarea id=\"description\"
                                                                                class=\"form-control\" name=\"description\"
                                                                                rows=\"3\"
                                                                                placeholder=\"Enter product description\"
                                                                                required>";
            // line 237
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "description", [], "any", false, false, false, 237), "html", null, true);
            yield "</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class=\"col-md-12\">
                                                                        <div class=\"form-group form-group-default\">
                                                                            <label for=\"stock\">Stock</label>
                                                                            <input type=\"number\" id=\"stock\"
                                                                                class=\"form-control\" name=\"stock\"
                                                                                placeholder=\"Enter product stock\"
                                                                                value=\"";
            // line 246
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "stock", [], "any", false, false, false, 246), "html", null, true);
            yield "\"
                                                                                required></input>
                                                                        </div>
                                                                    </div>
                                                                    <div class=\"col-md-12\">
                                                                        <div class=\"form-group form-group-default\">
                                                                            <img id=\"image\"
                                                                                src=\"../img/products/<?php echo \$product['image']; ?>\"
                                                                                alt=\"\">
                                                                            <label for=\"image\">Product
                                                                                Image</label>
                                                                            <input id=\"preview\" type=\"file\"
                                                                                class=\"form-control-file\" name=\"image\"
                                                                                value=\"<?php echo \$product['image']; ?>\"
                                                                                required>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class=\"modal-footer border-0\">
                                                                    <button type=\"submit\" class=\"btn btn-primary\"
                                                                        name=\"edit\">
                                                                        Edit Product
                                                                    </button>
                                                                    <button type=\"button\" class=\"btn btn-secondary\"
                                                                        data-bs-dismiss=\"modal\">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Edit -->

                                            <button type=\"button\" class=\"btn btn-link\"
                                                onclick=\"confirmDelete('";
            // line 281
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 281), "html", null, true);
            yield "')\">
                                                <i class=\"fa fa-times text-danger\"></i>
                                            </button>

                                            <!-- <script>
                                                function confirmDelete(productId) {
                                                    Swal.fire({
                                                        title: \"Are you sure?\",
                                                        text: \"You won't be able to revert this!\",
                                                        icon: \"warning\",
                                                        showCancelButton: true,
                                                        confirmButtonColor: \"#3085d6\",
                                                        cancelButtonColor: \"#d33\",
                                                        confirmButtonText: \"Yes, delete it!\"
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            Swal.fire({
                                                                title: 'Deleted!',
                                                                text: 'Your file has been deleted.',
                                                                icon: 'success'
                                                            }).then(() => {
                                                                window.location.href =
                                                                    'proses-hapus-products.php?id=' +
                                                                    productId;
                                                            });
                                                        }
                                                    });
                                                }
                                            </script> -->
                                        </div>
                                    </td>
                                </tr>
                                ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 314
        yield "                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "home.html";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  441 => 314,  394 => 281,  356 => 246,  344 => 237,  330 => 226,  299 => 198,  295 => 197,  282 => 187,  273 => 181,  246 => 157,  238 => 152,  231 => 148,  227 => 147,  223 => 146,  219 => 145,  213 => 142,  209 => 141,  206 => 140,  189 => 139,  54 => 6,  50 => 5,  45 => 1,  43 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "home.html", "C:\\laragon\\www\\slim-project\\templates\\home.html");
    }
}
