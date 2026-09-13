<?php

namespace App\Rules;

use App\Models\Persona;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class UniqueCarnet implements DataAwareRule, ValidationRule
{
    protected array $data = [];

    public function __construct(
        protected ?int $exceptId = null
    ) {}

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Run the validation rule.
     */
    public function validate(
        string $attribute,
        mixed $value,
        Closure $fail
    ): void {
        $query = Persona::where('carnet', $value);

        // Si estamos editando, ignoramos la persona actual.
        if ($this->exceptId !== null) {
            $query->where('id_persona', '!=', $this->exceptId);
        }

        $complementario = $this->data['complementario'] ?? null;

        if ($complementario === null || $complementario === '') {
            $query->whereNull('complementario');
        } else {
            $query->where('complementario', $complementario);
        }

        if ($query->exists()) {
            if ($complementario === null || $complementario === '') {
                $fail('El carnet ya está registrado.');
            } else {
                $fail('El carnet y el complementario ya están registrados.');
            }
        }
    }
}
