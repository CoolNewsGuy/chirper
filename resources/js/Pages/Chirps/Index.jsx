import { Head, useForm } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";
import Chirp from "@/Components/Chirp";
import { useEffect } from "react";

export default function Index({ auth, chirps }) {
  const { data, setData, post, processing, reset, errors } = useForm({
    message: "",
  });

  /**
   *
   * @param {React.FormEvent<HTMLFormElement>} e
   */
  function onSubmit(e) {
    e.preventDefault();

    post(route("chirps.store"), {
      onSuccess: () => reset(),
    });
  }

  return (
    <AuthenticatedLayout user={auth.user}>
      <Head title="Chirps" />

      <div className="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form onSubmit={onSubmit}>
          <textarea
            value={data.message}
            placeholder="What's on your mind?"
            className="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            onChange={(e) => setData("message", e.target.value)}
          ></textarea>
          <InputError message={errors.message} className="mt-2" />
          <PrimaryButton disabled={processing} className="mt-4">
            Chirp
          </PrimaryButton>
        </form>

        <div className="mt-6 bg-white shadow-sm rounded-lg divide-y">
          {chirps.map((chirp) => (
            <Chirp key={chirp.id} chirp={chirp} />
          ))}
        </div>
      </div>
    </AuthenticatedLayout>
  );
}
