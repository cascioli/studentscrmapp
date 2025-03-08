class Course {
  final int id;
  final String nome;
  final String? citta;
  final DateTime? inizioCorso;
  final DateTime? fineCorso;
  final int itsId;

  Course({
    required this.id,
    required this.nome,
    this.citta,
    this.inizioCorso,
    this.fineCorso,
    required this.itsId,
  });

  factory Course.fromJson(Map<String, dynamic> json) {
    return Course(
      id: json['id'],
      nome: json['nome'],
      itsId: json['its_id'],
      citta: json['citta'] ?? 'N/A',
      inizioCorso: DateTime.tryParse(json['inizio_corso']) ?? DateTime.now(),
      fineCorso: DateTime.tryParse(json['fine_corso']) ?? DateTime.now(),
    );
  }
}
