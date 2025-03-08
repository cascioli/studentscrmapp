part of 'courses_bloc.dart';

abstract class CoursesState extends Equatable {
  const CoursesState();

  @override
  List<Object> get props => [];
}

class CoursesInitial extends CoursesState {}

class CoursesLoading extends CoursesState {}

class CoursesLoaded extends CoursesState {
  final List<Course> courses;
  const CoursesLoaded(this.courses);

  @override
  List<Object> get props => [courses];
}

class CoursesFailure extends CoursesState {
  final String error;
  const CoursesFailure(this.error);

  @override
  List<Object> get props => [error];
}
