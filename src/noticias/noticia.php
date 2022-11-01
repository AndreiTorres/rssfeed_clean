<?

class Noticia {

    private ?string $titulo;
    private ?string $enlace;
    private ?string $descripcion;
    private ?string $fechaPost;
    private ?string $fechaPublicacion;
    private ?string $categoria;
    private ?string $imagen;
    private ?string $texto;

    function __construct(string $titulo, string $enlace, 
                        string $descripcion, string $fechaPost,
                        string $fechaPublicacion, string $categoria,
                        string $imagen, string $texto) {
        
                            $this->titulo = $titulo;
                            $this->enlace = $enlace;
                            $this->descripcion = $descripcion;
                            $this->fechaPost = $fechaPost;
                            $this->fechaPublicacion = $fechaPublicacion;
                            $this->categoria = $categoria;
                            $this->imagen = $imagen;
                            $this->texto = $texto;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getEnlace() {
        return $this->enlace;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }
    
    public function getFechaPost() {
        return $this->getFechaPost;
    }

    public function getFechaPublicacion() {
        return $this->getFechaPublicacion;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function getTexto() {
        return $this->texto;
    }
}

?>